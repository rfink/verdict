'''

'''

from Decision.Comparison.CompareAbstract import CompareAbstract


class GreaterThan(CompareAbstract):
	
	
	def compare(self):
		
		return self.contextVar > self.configVar