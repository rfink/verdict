'''

'''

from Decision.Comparison.CompareAbstract import CompareAbstract

class Or(CompareAbstract):
	
	
	def compare(self):
		
		if (self.contextVar or self.configVar):
			
			return True
		
		return False
