'''

'''

from Decision.Comparison.CompareAbstract import CompareAbstract


class Xor(CompareAbstract):
	
	
	def compare(self):
		
		return self.contextVar ^ self.configVar
